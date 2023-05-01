FROM python:3.9

WORKDIR /app

COPY requirements.txt ./
RUN pip install --no-cache-dir -r requirements.txt

COPY handl_caxl1.py ./

CMD ["python", "./handl_caxl1.py"]