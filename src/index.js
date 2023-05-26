import express from 'express'
import employes from './routes/employes.js'
import products from './routes/products.js'


const app = express()

app.use(express.json())

app.use('/api',employes)
app.use('/api/',products)

app.use((req, res, next) => {
    res.status(404).json({
        message: 'endpoint Not Found'
    })
})

const PORT =  3000
app.listen(PORT)

console.log("Running por "+PORT)