# challenge_zerf

Si desean probarlo con docker deben seguir los siguientes pasos:

1. Tener docker instalado
2. Pocicionarse en la bash del proyecto
3. Buildear la imagen con `docker build -t zerf .`
4. Levantar el contendor con `docker run -v C:/Users/valen/challenge_zerf/src:/var/www/html -p 8080:80 zerf`
5. Entrar al localhost:8080