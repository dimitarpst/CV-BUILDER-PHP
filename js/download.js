document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.download-cv-btn').forEach(button => {
        button.addEventListener('click', downloadCVasPDF);
    });
});

function downloadCVasPDF() {
    const cvId = this.closest('.cv-card').getAttribute('data-cv-id');
    fetch(`cv.php?cv_id=${cvId}`)
        .then(response => response.text())
        .then(html => {
            const html2pdf = window.html2pdf;
            const opt = {
                filename: `CV-${cvId}.pdf`,
                html2canvas: { scale: 3 },
                jsPDF: { orientation: 'portrait', unit: 'cm', format: 'A4' },
                pagebreak: { mode: ['avoid-all','css','legacy'] }
            };
            html2pdf().from(html).set(opt).save();
        })
        .catch(error => console.error('Error:', error));
}

/*
todooneday
function CvAsPdf() {
    const cvId = this.closest('.cv-card').getAttribute('data-cv-id');
    fetch(`cv.php?cv_id=${cvId}`)
        .then(response => response.text())
        .then(html => {
            const jsPDF = window.jsPDF.jsPDF;
            const doc = new jsPDF({
                margin: 10,
                unit: 'pt',
                format: 'a4',
                compress: true,
                precision: 2,
            });
            
            const link = document.createElement('link');
            link.href = 'css/cv.css';
            link.rel = 'stylesheet';
            document.head.appendChild(link);
            
            doc.html(html, {
                callback: function (doc) {
                    doc.save(`CV-${cvId}.pdf`);
                    location.reload();
                }

            });
        })
        .catch(error => console.error('Error :', error));
}*/
