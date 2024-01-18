#!/usr/bin/python3
"""
The User Class:
This class contains al the relevant
info for the user's reservation,
and methods to validate the collected info
"""
import sys, uuid
import models


class User:
    """User Class"""
    def __init__(self, *args, **kwargs):
        """Initialize an instance of User"""
        self.u_id = str(uuid.uuid4())
        self.u_name = guestName

