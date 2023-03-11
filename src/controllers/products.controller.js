import {pool} from '../db.js';

export const getProducts = async (req,res) => {
    try{
        const [rows] = await pool.query("SELECT * FROM product")
        res.json(rows);
    }catch (error) {
        return res.status(500).json({
            message: "Algo salió mal"
        })
    }
}

export const getProduct = async (req,res) => {
    try{
        const [rows] = await pool.query("SELECT * FROM product WHERE id = ?",[req.params.id])
        if (rows.length <= 0){
            return res.status(404).json({message:
                    "Product not found"
            })
        }
        res.json(rows[0]);
    }catch (error) {
        return res.status(500).json({
            message: "Algo salió mal"
        })
    }
}

export const createProduct = async (req,res)=> {
    try{
        const {name,category,price} = req.body
        const [rows] = await pool.query("INSERT INTO product(name,category,price) VALUES (?,?,?)",[name,category,price])
       res.send({
           id: rows.insertId,
           name,
           category,
           price,
       })
    }catch (error){
        return res.status(500).json({
            message: "Algo salió mal"
        })
    }
}

export const updateProduct = async (req,res)=> {
    const {id} = req.params
    const {name,category,price} = req.body
    try{
        const [result] = await pool.query("UPDATE product SET name = IFNULL(?,name),category = IFNULL(?,category),price = IFNULL(?,price) WHERE id = ?",[name,category,price,id])
        if(result.affectedRows <= 0 ){
            return res.status(400).json({message:"Product not found"})
        }
        const [rows] = await pool.query("SELECT * FROM product where id = ?", [id])
        res.json(rows[0])
    }catch (error){
        return res.status(500).json({
            message: "Algo salió mal"
        })
    }
}

export const deleteProduct = async (req,res)=> {
    const {id} = req.params
   try {
       const[result] = await pool.query("DELETE FROM product WHERE id = ?",[id])
       if(result.affectedRows <= 0 ){
           return res.status(404).json({message:"Product not found"})
       }
       res.sendStatus(204).json({message:"Product deleted"})
   }catch (error){
       return res.status(500).json({
           message: "Algo salió mal"
       })
   }

}

