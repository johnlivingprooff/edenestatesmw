from mailchimp_marketing import Client

mailchimp = Client()
mailchimp.set_config({
  "api_key": "527355d6d97fbe5784f9b78d25d5c2c2-us21",
  "server": "us21"
})

response = mailchimp.ping.get()
print(response)
