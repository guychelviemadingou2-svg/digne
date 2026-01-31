# Configuration des Emails (Optionnel)

Pour ajouter des notifications par email dans StockPro, modifier le fichier `.env` :

## 🔧 Configuration SMTP

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@stockpro.com"
MAIL_FROM_NAME="StockPro"
```

## 📧 Services Recommandés

### Option 1: Mailtrap (Gratuit pour test)
1. Créer un compte sur [mailtrap.io](https://mailtrap.io)
2. Copier les identifiants SMTP
3. Mettre à jour `.env`

### Option 2: Gmail
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=votre.email@gmail.com
MAIL_PASSWORD=votre_mot_de_passe_app
MAIL_ENCRYPTION=tls
```

### Option 3: Localhost (Développement)
```env
MAIL_MAILER=log
```
Les emails s'affichent dans les logs.

---

## 🔔 Notifications d'Alertes (Implémentation Future)

Si vous voulez ajouter des notifications par email quand :
- Stock atteint le minimum
- Produit arrive à expiration
- Rupture de stock

Créer un événement :
```php
php artisan make:event ProductAlertEvent
```

Et l'ajouter au modèle Product.

---

## 📞 Pour Plus d'Informations

Voir la documentation Laravel :
https://laravel.com/docs/11.x/mail
