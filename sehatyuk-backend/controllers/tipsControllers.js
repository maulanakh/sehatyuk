const db = require('../db');

exports.getAllTips = (req, res) => {
  db.query('SELECT * FROM tips ORDER BY tanggal_post DESC', (err, results) => {
    if (err) return res.status(500).json({ error: 'Gagal mengambil tips' });
    res.json(results);
  });
};

exports.createTip = (req, res) => {
  const { judul, isi } = req.body;
  db.query(
    'INSERT INTO tips (judul, isi) VALUES (?, ?)',
    [judul, isi],
    (err, result) => {
      if (err) return res.status(500).json({ error: 'Gagal menyimpan tips' });
      res.json({ message: 'Tips berhasil ditambahkan' });
    }
  );
};

// Ambil 1 tips berdasarkan ID
exports.getTipById = (req, res) => {
  const { id } = req.params;
  db.query('SELECT * FROM tips WHERE id = ?', [id], (err, results) => {
    if (err) return res.status(500).json({ error: 'Gagal mengambil tips' });
    if (results.length === 0) return res.status(404).json({ error: 'Tips tidak ditemukan' });
    res.json(results[0]);
  });
};

// Update tips berdasarkan ID
exports.updateTip = (req, res) => {
  const { id } = req.params;
  const { judul, isi } = req.body;
  db.query(
    'UPDATE tips SET judul = ?, isi = ? WHERE id = ?',
    [judul, isi, id],
    (err, result) => {
      if (err) return res.status(500).json({ error: 'Gagal memperbarui tips' });
      if (result.affectedRows === 0) return res.status(404).json({ error: 'Tips tidak ditemukan' });
      res.json({ message: 'Tips berhasil diperbarui' });
    }
  );
};

// Hapus tips berdasarkan ID
exports.deleteTip = (req, res) => {
  const { id } = req.params;
  db.query('DELETE FROM tips WHERE id = ?', [id], (err, result) => {
    if (err) return res.status(500).json({ error: 'Gagal menghapus tips' });
    if (result.affectedRows === 0) return res.status(404).json({ error: 'Tips tidak ditemukan' });
    res.json({ message: 'Tips berhasil dihapus' });
  });
};

