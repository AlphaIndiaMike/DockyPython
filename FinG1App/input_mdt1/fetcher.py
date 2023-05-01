import yfinance as yf
from pymongo import MongoClient
import os

def download_ticker_data(ticker, start_date='2000-01-01', end_date='2023-05-01'):
    symbol = yf.Ticker(ticker)
    data = symbol.history(start=start_date, end=end_date)
    return data

def store_data_in_mongodb(data, ticker, connection_string='mongodb://mongo:27017'):
    client = MongoClient(connection_string)
    db = client.ticker_data
    collection = db[ticker]

    for index, row in data.iterrows():
        doc = {
            'timestamp': index,
            'open': row['Open'],
            'high': row['High'],
            'low': row['Low'],
            'close': row['Close'],
            'volume': row['Volume'],
            'dividends': row['Dividends'],
            'stock_splits': row['Stock Splits']
        }
        collection.insert_one(doc)

if __name__ == "__main__":
    tickers = ['AAPL', 'MSFT', 'TSLA', 'AMZN']
    mongodb_connection_string = 'mongodb://mongo:27017'

    for ticker in tickers:
        print(f"Downloading data for {ticker}...")
        data = download_ticker_data(ticker)
        print(f"Storing data for {ticker} in MongoDB...")
        store_data_in_mongodb(data, ticker, mongodb_connection_string)

    print("Ticker data downloaded and stored in MongoDB.")
