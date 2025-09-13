import * as fs from 'fs';
import * as path from 'path';

const folderPath = './resources/views';

const translations = [
    { from: /\bovo\b/gi, to: 'egg' },
    { from: /\bovos\b/gi, to: 'eggs' },
    { from: /\bninho\b/gi, to: 'nest' },
    { from: /\bninhos\b/gi, to: 'nests' },
    { from: /\bnó\b/gi, to: 'node' },
    { from: /\bnós\b/gi, to: 'nodes' },
];

function translateText(text: string): string {
    let newText = text;
    for (const translation of translations) {
        newText = newText.replace(translation.from, (match) => {
            const lowerCaseMatch = match.toLowerCase();
            switch (lowerCaseMatch) {
                case 'ovo':
                    return 'Egg';
                case 'ovos':
                    return 'Eggs';
                case 'ninho':
                    return 'Nest';
                case 'ninhos':
                    return 'Nests';
                case 'nó':
                    return 'Node';
                case 'nós':
                    return 'Nodes';
                default:
                    return match;
            }
        });
    }
    return newText;
}

function processFile(filePath: string) {
    fs.readFile(filePath, 'utf8', (err, data) => {
        if (err) {
            console.error(`Erro ao ler o arquivo ${filePath}: ${err}`);
            return;
        }

        const newContent = translateText(data);

        fs.writeFile(filePath, newContent, 'utf8', (err) => {
            if (err) {
                console.error(`Erro ao escrever no arquivo ${filePath}: ${err}`);
                return;
            }
            console.log(`Arquivo ${filePath} processado com sucesso.`);
        });
    });
}

function processFolder(folderPath: string) {
    fs.readdir(folderPath, { withFileTypes: true }, (err, entries) => {
        if (err) {
            console.error(`Erro ao ler a pasta ${folderPath}: ${err}`);
            return;
        }

        for (const entry of entries) {
            const entryPath = path.join(folderPath, entry.name);
            if (entry.isDirectory()) {
                processFolder(entryPath);
            } else if (entry.isFile()) {
                processFile(entryPath);
            }
        }
    });
}

// Chame a função para iniciar o processamento da pasta
processFolder(folderPath);