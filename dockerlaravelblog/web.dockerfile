FROM nginx:1.10

#Se define los dos aragumentos y si no están definidos en el .env se establece su valor a 1000, q el UID del primer usuario en ubuntu
ARG UIDUser=1000
ARG GIDGroup=1000
RUN  usermod -u $UIDUser www-data && groupmod -g $GIDGroup www-data