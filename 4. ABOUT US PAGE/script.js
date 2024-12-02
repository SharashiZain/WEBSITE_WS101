document.addEventListener('DOMContentLoaded', () => {
    // pipli ng item dito 
    const menuItems = document.querySelectorAll('.menu-item');
    const aboutUsHeading = document.querySelector('.aboutus h1');

    //menu bar
    menuItems.forEach(item => {
        item.addEventListener('mouseenter', () => {
            menuItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.style.opacity = '0.5';
                }
            });
            item.style.transform = 'scale(1.2)';
            item.style.transition = 'all 0.3s ease';
        });

        item.addEventListener('mouseleave', () => {
            menuItems.forEach(otherItem => {
                otherItem.style.opacity = '1';
            });
            item.style.transform = 'scale(1)';
        });
    });

    // about us
    if (aboutUsHeading) {
        aboutUsHeading.addEventListener('mouseenter', () => {
            aboutUsHeading.style.transform = 'scale(1.1)';
            aboutUsHeading.style.textShadow = '2px 2px 8px rgba(0,0,0,0.3)';
            aboutUsHeading.style.color = '#ffffff'; //change color ng text
        });

        aboutUsHeading.addEventListener('mouseleave', () => {
            aboutUsHeading.style.transform = 'scale(1)';
            aboutUsHeading.style.textShadow = 'none';
            aboutUsHeading.style.color = '';
        });
    }

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0) scale(1)';
            card.style.boxShadow = '0 4px 8px rgba(0,0,0,0.1)';
            
            const heading = card.querySelector('h2');
            if (heading) {
                heading.style.color = '';
                heading.style.transform = 'scale(1)';
            }
            
            const paragraph = card.querySelector('p');
            if (paragraph) {
                paragraph.style.color = '';
            }
        });
    });