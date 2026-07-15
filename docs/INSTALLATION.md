# Installation VPS

## 1. Nettoyage ancien projet
```bash
cd ~/site
rm -rf woltk-wordpress
```

## 2. Cloner le repo
```bash
git clone https://github.com/Diego-c2c/woltk-wordpress.git
cd woltk-wordpress
```

## 3. Lancer Docker
```bash
docker compose up -d
docker compose ps
```

## 4. Ouvrir WordPress
Ouvrir `http://IP_DU_VPS:8090`

## 5. Finaliser
- Terminer l'installation WordPress
- Aller dans `Apparence > Thèmes`
- Activer `WoTLK Portal`
- Aller dans `Réglages > Lecture`
- Choisir `Une page statique`
- Sélectionner `Accueil`

## 6. Si tu redéploies de zéro
```bash
docker compose down -v
docker compose up -d
```
