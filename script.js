// ================================
// Travel Hub - Contact Form Script
// ================================

document.addEventListener("DOMContentLoaded", function () {

    const contactForm = document.getElementById("contactForm");

    if (contactForm) {

        contactForm.addEventListener("submit", function (event) {

            event.preventDefault();

            const name = document.getElementById("contactName").value.trim();
            const email = document.getElementById("contactEmail").value.trim();
            const message = document.getElementById("contactMessage").value.trim();

            if (name === "" || email === "" || message === "") {
                alert("Please fill in all fields.");
                return;
            }

            const whatsappNumber = "7666340910";

            const whatsappMessage =
`Name: ${name}
Email: ${email}

Message:
${message}`;

            // WhatsApp
            window.open(
                `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(whatsappMessage)}`,
                "_blank"
            );

            // Email
            window.location.href =
                `mailto:bhosalesrushti989@example.com?subject=Travel Hub Contact&body=${encodeURIComponent(whatsappMessage)}`;

            alert("Thank you for contacting Travel Hub!");

            contactForm.reset();

        });

    }

});