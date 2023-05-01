import os
import yfinance as yf
import pandas as pd
import graphyte
import pika
import time
import json


def download_ticker_data(ticker, start_date='2000-01-01', end_date='2023-05-01'):
    symbol = yf.Ticker(ticker)
    data = symbol.history(start=start_date, end=end_date)
    return data

def send_data_to_rabbitmq(data, ticker):
    connected = False
    while not connected:
        try:
            connection = pika.BlockingConnection(pika.ConnectionParameters(host='rabbitmq'))
            connected = True
        except pika.exceptions.AMQPConnectionError:
            print("Failed to connect to RabbitMQ. Retrying in 5 seconds...")
            time.sleep(5)

    channel = connection.channel()
    channel.queue_declare(queue='ticker_data', durable=True)

    for index, row in data.iterrows():
        message = {
            'ticker': ticker,
            'timestamp': index.isoformat(),
            'open': row['Open'],
            'high': row['High'],
            'low': row['Low'],
            'close': row['Close'],
            'volume': row['Volume'],
            'dividends': row['Dividends'],
            'stock_splits': row['Stock Splits']
        }
        channel.basic_publish(exchange='',
                              routing_key='ticker_data',
                              body=json.dumps(message),
                              properties=pika.BasicProperties(delivery_mode=2))

    connection.close()

if __name__ == "__main__":
    tickers = ['AAPL', 'MSFT', 'TSLA', 'AMZN']

    for ticker in tickers:
        print(f"Downloading data for {ticker}...")
        data = download_ticker_data(ticker)
        print(f"Sending data for {ticker} to RabbitMQ...")
        send_data_to_rabbitmq(data, ticker)

    print("Ticker data downloaded and sent to RabbitMQ.")
