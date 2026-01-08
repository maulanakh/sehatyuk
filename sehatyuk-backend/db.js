const mysql = require('mysql2');
require('dotenv').config();
// db.js - Koneksi ke database MySQL

const conn = mysql.createConnection({
    host: process.env.DB_HOST,
    port: process.env.DB_PORT,
    user: process.env.DB_USER,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_NAME
});

conn.connect(err => {
    if (err) throw err;
    console.log('✅ Terhubung ke database');
});

module.exports = conn;
