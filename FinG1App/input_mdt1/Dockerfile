# Use the official Python image as the base image
FROM python:3.9

# Set the working directory
WORKDIR /app

# Copy requirements.txt to the container
COPY requirements.txt .

# Install required libraries
RUN pip install --no-cache-dir -r requirements.txt

# Copy the fetcher.py script to the container
COPY fetcher.py .

# Run the fetcher.py script when the container is started
CMD ["python", "fetcher.py"]
