# nursery_system
current admin account is : maz05@gmail.com => Mazin1234

For Adding Admin Account run this query in sql command:
INSERT INTO users(username, email, pass, phone, rule, isVerified) VALUES ('{USER_NAME}', aes_encrypt('{YOUR_EMAIL}','passkey'), aes_encrypt('{YOU_RPASS}','passkey'), aes_encrypt('{YOUR_PHONE','passkey'), 'Admin', true);
