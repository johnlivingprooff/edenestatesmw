#!/usr/bin/python3
"""
This is the web application for the website, 
controls all the necessary functions
"""
from flask import Flask, request, jsonify
from models import User
from datetime import datetime


app = Flask(__name__)


@app.route('/api/reservations', methods=['POST'])
def create_reservation():
    reservation_data = request.get_json()
    checkin = reservation_data.get('checkin')
    checkout = reservation_data.get('checkout')
    guests = reservation_data.get('guests')


    user = User(checkin=checkin, checkout=checkout, guests=guests)
    # Save user to database...
    print("Got here!")

    return jsonify({'message': 'Reservation created successfully!'}), 201