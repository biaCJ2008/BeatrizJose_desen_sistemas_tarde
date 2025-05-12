from selenium import webdriver
from selenium.webdriver.common.by import By
import time 

#Configuração do WebrDriver (nesse exmplo, estamos usando o Chrome)
driver= webdriver.Chrome()

#Acessa a página de cadastro usando o caminho absluto 
#com o protocolo file://
#Certifique-se de que o caminho esta apontando para um arquivo
#HTML especifico
driver.get("file:///C:/Users/beatriz_jose/Documents/GitHub/BeatrizJose_desen_sistemas_tarde/teste_de_sistema/testeindex.html")

#Preencha o campo Nome 
codProd_input = driver.find_element(By.ID,"codPeca")
codProd_input.send_keys("111")

#Preencha o campo cpf
desc_input = driver.find_element(By.ID,"descricao")
desc_input.send_keys("Legal")

#Preencha o campo endereço
marca_input = driver.find_element(By.ID,"marca")
marca_input.send_keys("Alexandria")

#Preencha o campo telefone
preco_input = driver.find_element(By.ID,"preco")
preco_input.send_keys("11987654321")

quant_input = driver.find_element(By.ID,"quantidade")
quant_input.send_keys("11987654321")

time.sleep(90)

#Clica no botão de Cadastrar
submit_button=driver.find_element(By.CSS_SELECTOR, "button[type='submit']")
submit_button.click()

driver.quit()
