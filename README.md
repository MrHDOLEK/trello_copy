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
         "password_confirmation": "test",
         "address": "example address",
         "regulation_accepted": true    
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

# System tablic
- Aby utworzyć tablice musisz być zalogowany i aby edytować jakomś musisz być jej właścicielem 
- "is_visible" : 1 tablica jest publiczna
- "is_visible" : 0 tablica jest prywatna (domyśnie jak tworzysz tablice jest ona prywatna)
- id mozesz przekazywać w url lub w rensponse zależy jak ci wygodnie
- Przy usuwaniu tablicy usuwasz całą zawartość podobnie  z card.
- Ps.Dojdzie system przypisywania ludzi do taska i teamów do tablic i ze admin może wszystko.Plus system motywów ze użytkownik może sobie obrazek wstawić czy gotowy motyw do tablicy.
- System teamów i permisji do tablic card już jest.


### Metoda GET

1. **Pobranie listy publicznych tablic `/api/v1/manage/tables/public`**
2. **Pobranie szczegółów danej tablicy `/api/v1/manage/tables/public/details?id=tutaj id tablicy`**
3. **Pobranie listy prywatnych tablic `/api/v1/manage/tables/private`**
4. **Pobranie szczegółów danej tablicy prywatnej `/api/v1/manage/tables/private/details?id=tutaj id tablicy`**

### Metoda POST

1. **Tworzenie tablicy `/api/v1/manage/tables`**

```json
{
    "name": "kys2322123"
}
```

2. **Tworzenie carda w tablicy `/api/v1/manage/cards?id=tutaj id tablicy`**

```json
{
    "card_name": "kys2322123",
    "card_content": "ksksksksksks"
}
```

3. **Tworzenie taska w tablicy `/api/v1/manage/tasks?id=tutaj id carda`**

```json
{
    "task_name": "kys2322123",
    "task_content": "ksksksksksks"
}
```

### Metoda PUT

1. **Aktualizacja tablicy `/api/v1/manage/tables?id=tutaj id tablicy`**

```json
{
    "name": "kys2322123", 
    "is_visible": 1, 
    "team_id" : id teamu [nie jest wymagany] jezeli nie ma id to usuwamy team tak naprawde z tablicy
}
```

2. **Aktualizacja carda w tablicy `/api/v1/manage/cards?id=tutaj id carda`**

```json
{
    "card_name": "kys2322123",
    "card_content": "ksksksksksks"
}
```

3. **Aktualizacja taska w tablicy `/api/v1/manage/tasks?id=tutaj id taska`**

```json
{
    "task_name": "kys2322123",
    "task_content": "ksksksksksks"
}
```

### Metoda DELETE

1. **Usuwanie tablicy razem z całą zawartościa `/api/v1/manage/tables?id=tutaj id tablicy`**

2. **Usuwanie carda w tablicy `/api/v1/manage/cards?id=tutaj id carda`**

3. **Usuwanie taska w tablicy `/api/v1/manage/tasks?id=tutaj id taska`**

# System zespołów
Przypisywanie zespołu do danej tablicy odbywa się poprzez aktualizacje samej tablicy
### Metoda GET

1. **Pokazanie w jakich zespołach jest jezeli jest tworca tablicy`/api/v1/manage/teams`**
2. **Pokazanie wszystkich zespołów [tylko admin] dostepna tutaj jest paginacja max 20 wyników na strone `/api/v1/manage/teams`**

### Metoda POST
1. **Utworzenie zespołu i przypisanie go do tablicy`/api/v1/manage/teams?id=id tablicy`**
 Jeżeli nie podasz id tablicy to zostanie utworzony team ale nie zostanie przypisany do danej tablicy.Jezeli chcesz przypisać team do konkretnej tablicy to musisz uzyć innego endp.
```json
{
    "team_name": "kys2322123",
    "users_mail": [tutaj maile userów jako elementy arraya]
}
```
2. **Przypisanie konkretnego zespołu do  konkrentej tablicy(Można takze aktualizować tak)`/api/v1/manage/teams/assignment`**
```json
{
    "id_team": 3,
    "id_table": 5
}
```
### Metoda PUT
1. **Aktualizacja zespołu`/api/v1/manage/teams?id=id tablicy`**
```json
{
    "team_name": "kys2322123",
    "users_mail": [tutaj maile userów jako elementy arraya]
}
```
### Metoda DELETE
1. **Usuniecie całego zespołu`/api/v1/manage/teams?id=id tablicy`**
