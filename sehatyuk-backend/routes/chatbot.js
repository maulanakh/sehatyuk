const express = require('express');
const router = express.Router();
const chatbotController = require('../controllers/chatbotControllers');

router.post('/', chatbotController.chatWithGemini);

module.exports = router;
