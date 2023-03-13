import {createPool} from 'mysql2/promise'

export const pool = createPool({
    host: '82.180.172.52',
    user: 'u535680116_companydb',
    password: 'Invest05!',
    port: 3306,
    database: 'u535680116_companydb'
})

