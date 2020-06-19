import requests

url = 'https://app.nanonets.com/api/v2/OCR/Model/8d50b8a0-c227-490e-9503-87951487c61a/LabelFile/'

data = {'file': open('C://xampp//htdocs//fyp//load//2.jpg', 'rb')}

response = requests.post(url, auth=requests.auth.HTTPBasicAuth('LUAD09AU177Ic51IOAFmk7Ro1gwEXIzd', ''), files=data)

f = open('C://xampp//htdocs//json//scanOut.json',"w")

f.write (response.text)
print(response.text)