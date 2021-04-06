
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Routy

# Rejestracja/Logowanie


### Metoda POST

1. **Rejestracja `/api/v1/auth/signup`**
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
         "message" : "Successfully created user!"
   }
   ``` 
	  
2. **Logowanie `/api/v1/auth/login`**
	```json
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
### Metoda GET
3. **Użytkownik `/api/v1/auth/user`**
4. **Wylogowanie `/api/v1/auth/logout`**  

# Zarządzanie danymi personalnymi użytkownika

### Metoda POST

1. **Awatar `/api/v1/user/avatar/post`**
- Należy wysłać obraz z rozszerzeniem *jpg*
    ```json
    {
        "image": "image_here.jpg"
    }
    ```
- Jeśli uda się zapisać awatar to otrzymasz taką wiadomość
    ```json
    {
        "message": "Success!"
    }
    ```
### Metoda GET

1. **Awatar `/api/v1/user/avatar`**
- Jeśli uda się pobrać awatar to otrzymasz go jako *blob*

2. **Adres `/api/v1/user/address/`**
- Jeśli uda się pobrać adres to otrzymasz taką wiadomość
    ```json
    {
        "address": [
            {
                "address": "updated address"
            }
        ]
    }
    ```

3. **Akceptacja regulaminu `/api/v1/user/regulation`**
- Jeśli uda się pobrać akceptacje regulaminu to otrzymasz taką wiadomość
    ```json
    {
        "regulation_accepted": [
            {
                "regulation_accepted": 1
            }
        ]
    }   
    ```

### Metoda PUT

1. **Adres `/api/v1/user/address/update`**
    ```json
    {
        "address": "example address"
    }
    ```
- Jeśli uda się zapisać adres to otrzymasz taką wiadomość
    ```json
    {
        "message": "Success! Address updated!"
    }
    ```

2. **Akceptacja regulaminu `/api/v1/user/regulation/update`**
    ```json
    {
       "regulation_accepted": false
    }
    ```
- Jeśli uda się zapisać wartość to otrzymasz taką wiadomość
    ```json
    {
        "message": "Succes! Regulation set as accepted!"
    }
    ```

### Metoda DELETE

1. **Awatar `/api/v1/user/avatar/delete`**
- Jeśli uda się usunąć awatar to otrzymasz taką wiadomość
    ```json
    {
        "message": "Success! Avatar deleted!"
    }
    ```

2. **Adres `/api/v1/user/address/delete`**
- Jeśli uda się usunąć adres to otrzymasz taką wiadomość
    ```json
    {
        "message": "Success! Address deleted!"
    }
    ```
