import mysql.connector

# Connect to MySQL
connection = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="rentease_ai"
)

cursor = connection.cursor(dictionary=True)

# -----------------------------
# Vehicle selected by customer
# -----------------------------
selected_vehicle = "Honda Activa 6G"

# Get selected vehicle details
cursor.execute(
    "SELECT * FROM vehicles WHERE vehicle_name=%s",
    (selected_vehicle,)
)

selected = cursor.fetchone()

if selected is None:
    print("Vehicle not found!")
    exit()

print("=" * 50)
print("SELECTED VEHICLE")
print("=" * 50)
print(f"Name  : {selected['vehicle_name']}")
print(f"Brand : {selected['brand']}")
print(f"Type  : {selected['vehicle_type']}")
print(f"Fuel  : {selected['fuel_type']}")
print(f"Price : ₹{selected['price_per_day']}/day")

print("\n")
print("=" * 50)
print("RECOMMENDED VEHICLES")
print("=" * 50)

# Find similar vehicles
cursor.execute("""
SELECT * FROM vehicles
WHERE vehicle_type=%s
AND fuel_type=%s
AND id != %s
""",
(
selected['vehicle_type'],
selected['fuel_type'],
selected['id']
))

recommendations = cursor.fetchall()

for vehicle in recommendations:
    print(f"🚗 {vehicle['vehicle_name']}")
    print(f"Brand : {vehicle['brand']}")
    print(f"Price : ₹{vehicle['price_per_day']}/day")
    print("-" * 30)

cursor.close()
connection.close()