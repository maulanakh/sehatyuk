const express = require('express');
const router = express.Router();
const tipsController = require('../controllers/tipsControllers');

router.get('/', tipsController.getAllTips);
router.post('/', tipsController.createTip);
router.get('/:id', tipsController.getTipById);
router.put('/:id', tipsController.updateTip);
router.delete('/:id', tipsController.deleteTip);


module.exports = router;
