import json
import graphyte
import pika
import time
from datetime import datetime

graphyte.init('graphite', prefix='stocks')

def store_data_in_graphite(data):
    timestamp = int(datetime.fromisoformat(data['timestamp']).timestamp())
    for field in ['open', 'high', 'low', 'close', 'volume', 'dividends', 'stock_splits']:
        metric_path = f"{data['ticker']}.{field}"
        value = data[field]
        graphyte.send(metric_path, value, timestamp)

def on_message(channel, method, properties, body):
    data = json.loads(body)
    store_data_in_graphite(data)
    channel.basic_ack(delivery_tag=method.delivery_tag)

def main():
    while True:
        try:
            connection = pika.BlockingConnection(pika.ConnectionParameters(host='rabbitmq'))
            channel = connection.channel()

            queue_name = 'ticker_data'
            channel.queue_declare(queue=queue_name, durable=True)

            channel.basic_qos(prefetch_count=1)
            channel.basic_consume(queue=queue_name, on_message_callback=on_message)

            print(" [*] Waiting for messages. To exit, press CTRL+C")
            channel.start_consuming()
        except pika.exceptions.ConnectionClosedByBroker:
            print("Connection was closed by the broker. Retrying in 5 seconds...")
            time.sleep(5)
        except pika.exceptions.AMQPConnectionError:
            print("Failed to connect to RabbitMQ. Retrying in 5 seconds...")
            time.sleep(5)



if __name__ == "__main__":
    print("Graphyte Handler Started...")
    main()
