import {pool} from "../db.js";

   export const getEmployes = async (req,res) => {
      try{
         const [rows] = await pool.query("SELECT * FROM employe")
         res.json(rows);
      }catch (error) {
         return res.status(500).json({
            message: "Algo salió mal"
         })
      }
   }

   export const getEmploye = async (req,res) => {
      try{
         const [rows] = await pool.query("SELECT * FROM employe WHERE id = ?",[req.params.id])
         if (rows.length <= 0){
            return res.status(404).json({
               message: 'Employe no found',
               status: 404,
            })
         }
         res.send({
            data:rows[0],
            status: 200
         });
      }catch (error){
         return res.status(500).json({
            message: "Algo salió mal"
         })
      }
   }

   export const createEmployes = async (req,res) => {
      try{
         const {name,salary} = req.body
         const [rows] = await pool.query('INSERT INTO employe (name, salary) VALUES (?, ?)',[name,salary])
         res.send({
            id: rows.insertId,
            name,
            salary,
            status: 200,
         })
      }catch (error){
         return res.status(500).json({
            message: "Algo salió mal"
         })
      }
   }

   export const deleteEmploye = async (req,res) => {
      try{
         const [result] = await pool.query('DELETE FROM employe WHERE id = ?', [req.params.id]);
         if (result.affectedRows <= 0) return res.status(404).json({
            message: 'Employe no found'
         })
         res.send({
            status:200,
         })
      }catch (error) {
         return res.status(500).json({
            message: "Algo salió mal"
         })
      }
   }


export const updateEmploye = async (req,res) => {
   const {id} = req.params
   const {name,salary} = req.body
      try{
         const [result] = await pool.query('UPDATE employe SET name = IFNULL(?,name), salary = IFNULL(?,salary) WHERE id = ?', [name,salary,id])
         if (result.affectedRows <= 0) return res.status(404).json({
            message: 'Employe no found'
         })
         const [rows] = await pool.query('SELECT * FROM employe where id = ?', [id])
         res.send({
            data: rows[0],
            status: 200,
         })
      }catch (error) {
         return res.status(500).json({
            message: "Algo salió mal"
         })
      }
}


