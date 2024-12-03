import express, { response } from 'express';
import { Client } from 'whatsapp-web.js';

const client = new Client();
const app = express()

let qrm = '';
let stat = false;

client.on('qr', (qr) => {
    console.log('QR RECEIVED');
    qrm = qr;
});

client.on('ready', () => {
    stat = true;
    console.log('Client is ready!');
});

client.on('message', msg => {
    if (msg.body == 'hello') {
        msg.reply('hello x 2');
    }
});

async function deploy_all(req, res) {
    console.log(true);

    // Extract parameters from the request
    let number = `91${req.number}@c.us`;
    let name = req.name;
    let data = req.data;
    let time = req.time;
    let email = req.email;
    let gender = req.gender;

    // Create a message template
    let message = `Hello ${name},\n` +
        '\n' +
        `Here are your details:\n` +
        `Date: ${data}\n` +
        `Time: ${time}\n` +
        `Email: ${email}\n` +
        `Gender: ${gender}\n` +
        '\n' +
        `Thank you!`;

    console.log(message)

    // Check if the user is registered
    const isRegistered = await client.isRegisteredUser(number);
    if (!isRegistered) {
        return res.status(400).send('User not registered.'); // Ensure to return here
    }

    // Send the message
    try {
        await client.sendMessage(number, message);
        console.log('Message sent successfully:');
    } catch (error) {
        console.error('Error sending message:', error);
    }
}



function logoutde() {
    client.logout(0);
    client.initialize();
    stat = false;
    return true;
}

client.initialize();

app.get('/qr', function (req, res) {
    res.send({ qrs: qrm, status: stat })
})

app.use(express.json()); // Add this line to parse JSON bodies

app.post('/msg', function (req, res) {
    deploy_all(req.body, res)
});

app.get('/logout', function (req, res) {
    logoutde();
    console.log(stat);
    res.send({ status: stat });
})

app.listen(3000)
