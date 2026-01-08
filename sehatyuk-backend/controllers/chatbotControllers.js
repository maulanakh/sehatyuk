const https = require('https');
const axios = require('axios');

const agent = new https.Agent({ rejectUnauthorized: false }); // ❗ Abaikan validasi SSL

exports.chatWithGemini = async (req, res) => {
  const { message } = req.body;

  try {
    const result = await axios.post(
      `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${process.env.GEMINI_API_KEY}`,
      {
        contents: [{ parts: [{ text: message }] }]
      },
      {
        headers: { "Content-Type": "application/json" },
        httpsAgent: agent, // 👈 Tambahkan ini
      }
    );

    const reply = result.data.candidates[0].content.parts[0].text;
    res.json({ reply });
  } catch (error) {
    console.error('Gemini error:', error.response?.data || error.message);
    res.status(500).json({ error: 'Gagal menghubungi Gemini' });
  }
};
