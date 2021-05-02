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

- Jeśli uda się pobrać awatar to otrzymasz jego *url*

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

# Panel administratora

Wszystkie routy administratora są **zabezpieczone**.
W praktyce oznacza to, że wszelkie żądania wysłane z nieautoryzowanego konta (nie będącego adminem) otrzymają status **403|Forbidden**.

### Metoda POST

1. **Użytkownik `/api/v1/admin/manage/user/create`**
```json
{
    "name" : "CookieMonster",    
 	"email" : "coockie@monster.pl",   
    "password" :"CoockiesAreGreat",  
    "password_confirmation": "CoockiesAreGreat",  
    "address": "sesame street", //Address is not required
    "regulation_accepted": true
}
```

2. **Pakiet `/api/v1/admin/manage/portal/packet/create`**
```json
{
    "name": "ChickenNugget",
    "price": 9.99,
    "description": "Pretty tasty, huh?", //Descrpition is not required
    "permission_id": 1
}
```

3. **Artykuł `/api/v1/admin/manage/portal/article/create`**
```json
{
    "title": "How to be the best",
    "intro": "How to be the best", //this is not required
    "alias": "how-to-be-the-best",
    "full": "This is full description", //this is not required
    "style": 1, //this is not required
    "image": "rockybalboa.jpg",
    "removable": 1,
    "meta_title": "SEO title", //this is not required
    "meta_description": "SEO description", //this is not required
    "category_id": 1,
    "type_id": 1
}
```

4. **Kategoria artykułów `/api/v1/admin/manage/portal/article/category/create`**
```json
{
    "name": "Wealth",
    "description": "Just be yourself"
}
```

5. **Typ artykułu `/api/v1/admin/manage/portal/article/type/create`**
```json
{
    "name": "Health",
    "description": "Be healthy"
}
```

6. **Tablica `/api/v1/admin/manage/table/create`**
```json
{
    "name": "new great table"
}
```

### Metoda GET

1. **Użytkownik `/api/v1/admin/manage/user`**
```json
{
    "user_id": 1 //Left empty to recieve all users
}
```

2. **Dane personalne użytkownik wraz w uprawnieniami `/api/v1/admin/manage/user/details`**
```json
{
    "user_id": 1 //Left empty to recieve all users
}
```

3. **Pakiet `/api/v1/admin/manage/portal/packet`**
```json
{
    "packet_id": 1 //Left empty to recieve all packets
}
```

4. **Artykuł `/api/v1/admin/manage/portal/article`**
```json
{
    "article_id": 1 //Left empty recieve all articles
}
```

5. **Kategoria artykułu `/api/v1/admin/manage/portal/article/category`**
```json
{
    "article_id": 1 //Left empty recieve all articles
}
```

6. **Typ artykułu `/api/v1/admin/manage/portal/article/type`**
```json
{
    "article_category_id": 1 //Left empty recieve all categories
}
```

7. **Tablica `/api/v1/admin/manage/table`**
```json
{
    "id": 1 //Left empty recieve all tables
}
```

### Metoda PUT

1. **Użytkownik `/api/v1/admin/manage/user/update`**
```json
{
    "user_id": 4, //this is required
    "name": "John",
    "email": "email@email.pl",
    "password": "password"
}
```

2. **Pakiet `/api/v1/admin/manage/portal/packet/update`**
```json
{
    "packet_id": 2, //this is required
    "name": "updated name",
    "price": 12.50,
    "description": "description",
    "permission_id": 1
}
```

3. **Artykuł `/api/v1/admin/manage/portal/article/update`**
```json
{
    "article_id": 1, //only this is required
    "title": "How to be the best",
    "intro": "How to be the best", 
    "alias": "how-to-be-the-best",
    "full": "This is full description",
    "style": 1,
    "image": "rockybalboa.jpg",
    "removable": 1,
    "meta_title": "SEO title",
    "meta_description": "SEO description", 
    "category_id": 1,
    "type_id": 1
}
```

4. **Kategoria artykułu `/api/v1/admin/manage/portal/article/category/update`**
```json
{
    "article_category_id": 2,
    "name": "updatedname",
    "description": "description"
}
```

5. **Typ artykułu `/api/v1/admin/manage/portal/article/type/update`**
```json
{
    "article_type_id": 1,
    "name": "UPDATED NAME",
    "description": "description"
}
```

6. **Tablica `/api/v1/admin/manage/table/update`**
```json
{
    "id": 1, //only this is required
    "is_visible": 1,
    "name": "new great tabl11e",
    "team_id": 1
}
```

### Metoda DELETE 

1. **Użytkownik `/api/v1/admin/manage/user/delete`**
```json
{
    "user_id": 3
}
```

2. **Pakiet `/api/v1/admin/manage/portal/packet/delete`**
```json
{
    "packet_id": 3
}
```

3. **Artykuł `/api/v1/admin/manage/portal/article/delete`**
```json
{
    "article_id": 2
}
```

4. **Kategoria artykułu `/api/v1/admin/manage/portal/article/category/delete`**
```json
{
    "article_category_id": 1
}
```

5. **Typ artykułu `/api/v1/admin/manage/portal/article/type/delete`**
```json
{
    "article_type_id": 2
}
```

6. **Tablica `/api/v1/admin/manage/table/delete`**
```json
{
    "id": 2
}
```
