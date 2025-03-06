const { app, BrowserWindow } = require('electron');

let mainWindow;

app.on('ready', () => {
    mainWindow = new BrowserWindow({
        width: 800, 
        height: 600,
        webPreferences: {
            contextIsolation: true,
        }
    });

    mainWindow.loadFile('codebuddy.html'); // Seu arquivo HTML
});

app.on('window-all-closed', () => {
    if (process.platform !== 'darwin') {
        app.quit();
    }
});
