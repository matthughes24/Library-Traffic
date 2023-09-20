import time
from selenium import webdriver
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By

PATH = "D:\IEDriverServer.exe"


driver = webdriver.Ie(PATH)
driver.get("http://137.140.52.68/doc/page/login.asp?_1665286710077")
username = driver.find_element(By.ID,"username")
password = driver.find_element(By.ID,"password")
username.send_keys("admin")
password.send_keys("password!")
driver.find_element(By.CSS_SELECTOR,'.btn.btn-primary.login-btn').click()
#time.sleep(5)
