import {Router} from 'express'
import {getEmployes, createEmployes, updateEmploye, deleteEmploye, getEmploye} from '../controllers/employes.controller.js'

const router = Router();

router.get('/employes', getEmployes)
router.get('/employes/:id', getEmploye)
router.post('/employes', createEmployes)
router.patch('/employes/:id', updateEmploye)
router.delete('/employes/:id', deleteEmploye)
export default router

