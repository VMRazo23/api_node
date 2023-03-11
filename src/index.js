import express from 'express'
import employes from './routes/employes.js'
import products from './routes/products.js'


const app = express()

app.use(express.json())

app.use('/api',employes)
app.use('/api/',products)

app.use((req, res, next) => {
    res.status(404).json({
        message: ' endpoint Not Found'
    })
})

app.listen(3000)

console.log("Running por 3000")