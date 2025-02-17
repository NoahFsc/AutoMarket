FROM sonarqube:lts

# Définit l'utilisateur root pour copier les fichiers de config (optionnel)
USER root

# Copie la configuration personnalisée si nécessaire
COPY conf/ /opt/sonarqube/conf/
COPY extensions/ /opt/sonarqube/extensions/

# Change les permissions pour éviter les erreurs de permission
RUN chown -R sonarqube:sonarqube /opt/sonarqube

# Revenir à l'utilisateur SonarQube pour l'exécution
USER sonarqube

# Expose les ports SonarQube (9000 pour l'UI et API)
EXPOSE 9000

# Lancement de SonarQube
ENTRYPOINT ["/opt/sonarqube/bin/run.sh"]
