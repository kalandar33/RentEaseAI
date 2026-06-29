import mysql.connector
import json
import sys
from decimal import Decimal

# Connect to MySQL
connection = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="rentease_ai"
)

cursor = connection.cursor(dictionary=True)

# Check if vehicle name is provided
if len(sys.argv) < 2:
    print(json.dumps([]))
    exit()

vehicle_name = sys.argv[1]

# Get selected vehicle
cursor.execute(
    "SELECT * FROM vehicles WHERE vehicle_name = %s",
    (vehicle_name,)
)

selected = cursor.fetchone()

if selected:

    cursor.execute("""
        SELECT
            id,
            vehicle_name,
            brand,
            vehicle_type,
            fuel_type,
            availability,
            price_per_day,
            image
        FROM vehicles
        WHERE vehicle_type = %s
        AND fuel_type = %s
        AND id != %s
        LIMIT 3
    """,
    (
        selected["vehicle_type"],
        selected["fuel_type"],
        selected["id"]
    ))

    recommendations = cursor.fetchall()

    for vehicle in recommendations:

        for key, value in vehicle.items():

            if isinstance(value, Decimal):
                vehicle[key] = float(value)

    print(json.dumps(recommendations))

else:

    print(json.dumps([]))

cursor.close()
connection.close()