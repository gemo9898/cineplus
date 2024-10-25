const express = require('express');
const path = require('path');
const app = express();
const port = process.env.PORT || 48010;

app.use(express.static(path.join(__dirname, 'public')));

app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'index.html'));
});


app.listen(port, '0.0.0.0', () => {
    console.log(`Server is running on port ${port}`);
});