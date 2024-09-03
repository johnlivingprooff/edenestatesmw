from mailchimp_marketing import Client
from dotenv import load_dotenv
import os


load_dotenv()
mailchimp_api = os.getenv('MAILCHIMP_API_KEY')
mchimp_server_id = os.getenv('MAILCHIMP_SERVER_ID')

mailchimp = Client()
mailchimp.set_config({
  "api_key": mailchimp_api,
  "server": mchimp_server_id
})

response = mailchimp.ping.get()
print(response)
