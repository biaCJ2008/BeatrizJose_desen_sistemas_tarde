from selenium import webdriver
from selenium.webdriver.common.by import By
import time 

#Configuração do WebrDriver (nesse exmplo, estamos usando o Chrome)
driver= webdriver.Chrome()

#Acessa a página de cadastro usando o caminho absluto 
#com o protocolo file://
#Certifique-se de que o caminho esta apontando para um arquivo
#HTML especifico
driver.get("file:///C:/Users/beatriz_jose/Documents/GitHub/BeatrizJose_desen_sistemas_tarde/teste_de_sistema/index.html")

#Preencha o campo Nome 
nome_input = driver.find_element(By.ID,"name")
nome_input.send_keys("Beatriz")

#Preencha o campo cpf
cpf_input = driver.find_element(By.ID,"cpf")
cpf_input.send_keys("11122233344")

#Preencha o campo endereço
endereco_input = driver.find_element(By.ID,"address")
endereco_input.send_keys("Rua das Flores, 123")

#Preencha o campo telefone
telefone_input = driver.find_element(By.ID,"phone")
telefone_input.send_keys("11987654321")

#Clica no botão de Cadastrar
submit_button=driver.find_element(By.CSS_SELECTOR, "button[type='submit']")
submit_button.click()

time.sleep(3)

driver.quit()
