import express from 'express'
import employes from './routes/employes.js'
import products from './routes/products.js'


const app = express()

app.use(express.json())

app.use('/.netlify/functions/api/',employes)
app.use('/.netlify/functions/api/',products)

app.use((req, res, next) => {
    res.status(404).json({
        message: ' endpoint Not Found'
    })
})

const PORT = process.env.PORT || 3000
app.listen(PORT)

console.log("Running por "+PORT)