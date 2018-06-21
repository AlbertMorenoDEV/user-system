Ejercicio principal: El objetivo de la prueba es desarrollar una aplicación en PHP, sin UI, capaz de solucionar el problema usando persistencia en memoria.         

Desarrolla un sistema tolerante a errores responsable de comprobar el login y password de una lista usuarios con las siguientes condiciones:         

- Devuelva si un usuario existe en el sistema o no.         
- Devuelve si el usuario/password coinciden o no.         

 Añade la cobertura de tests que consideres necesaria para validar el funcionamiento de la aplicación.         

Ejercicio bonus: El objetivo de la prueba es desarrollar sólo el juego de tests (unitarios, funcionales o aceptación), sin implementación, con la idea de que un/a tercer/a desarrollador/a pudiera implementar la solución sólo leyendo los tests.         

En el sistema anterior, añade un nuevo caso de uso:         

- Si el usuario/password es correcto, cambiar la password sólo de su mismo usuario (utilizando el mecanismo de autenticación que considere oportuno).


* php -S 127.0.0.1:8000 -t public


curl --request POST \
  --url 'http://127.0.0.1:8000/login?username=test_user&password=123456' \
  --header 'content-type: application/x-www-form-urlencoded'