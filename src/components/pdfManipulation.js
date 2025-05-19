import { PDFDocument } from "pdf-lib";

function range(start, end) {
    let length = end - start + 1;
    return Array.from({ length }, (_, i) => start + i - 1);
}


const onFileSelected = async (e) => {
    const fileList = e.target.files;
    if (fileList?.length > 0) {
        const pdfArrayBuffer = await readFileAsync(fileList[0]);
    }
};

function readFileAsync(file) {
    return new Promise((resolve, reject) => {
        let reader = new FileReader();
        reader.onload = () => {
            resolve(reader.result);
        };
        reader.onerror = reject;
        reader.readAsArrayBuffer(file);
    });
}

