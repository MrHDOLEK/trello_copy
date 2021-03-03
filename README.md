
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


## Routy  
### Metoda POST
- Rejestracja `/api/auth/signup`  
	```json
	{    
		 "name" : "Aleksander",    
		 "email" : "test@test.pl",   
		 "password" :"test",  
		 "password_confirmation": "test"    
	}
	```
 - Jeśli się uda stworzyć użytkownika to dostaniesz taką wiadomość
	  ```json
	  {
		  "message":"Successfully created user!"
	  } 
	  ```
- Logowanie `/api/auth/login  `
``` json
	{    
		 "email" : "test@test.pl",   
		 "password" :"test",  
		 "remember_me"  :  1  
	  } 
 ```
- Jeśli się uda się zalogować to dostaniesz taką wiadomość
```json 
	{
		"access_token" : "13123132",  
		"token_type" : " Bearer" ,  
		"expires_at" : "2021-03-09 20:45:03"
	}
```
###  Metoda GET
- Użytkownik `/api/auth/user`  
- Wylogowanie `/api/auth/logout`  
