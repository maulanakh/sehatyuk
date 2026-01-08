const db = require('../db');
const bcrypt = require('bcrypt');

exports.register = (req, res) => {
    const { name, email, password, role } = req.body;
    const hash = bcrypt.hashSync(password, 10);

    db.query(
        'INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)',
        [name, email, hash, role || 'user'],
        (err, result) => {
            if (err) return res.status(500).json({ error: 'Gagal mendaftar' });
            res.json({ message: 'Pendaftaran berhasil' });
        }
    );

};

exports.login = (req, res) => {
    const { email, password } = req.body;

    db.query(
        'SELECT * FROM users WHERE email = ?',
        [email],
        (err, results) => {
            if (err || results.length === 0) {
                return res.status(401).json({ error: 'Email tidak ditemukan' });
            }

            const user = results[0];
            const valid = bcrypt.compareSync(password, user.password);
            if (!valid) {
                return res.status(401).json({ error: 'Password salah' });
            }

            res.json({ message: 'Login berhasil', user: { id: user.id, name: user.name, email: user.email, role: user.role } });
        }
    );
};
