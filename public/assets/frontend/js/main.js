



// -------------awards scroll------------vertical scroll------------------
// Get all container elements
const containers = document.querySelectorAll('.containerx');

// Loop through each container
containers.forEach((container) => {

  const list = container.querySelector('ul');
  const listItems = list.children;

  // Set the animation duration and delay
  const animationDuration = 2000; // 2 seconds
  const animationDelay = 2000; // 2 seconds

  // Flag to track whether the animation is paused
  let isPaused = false;

  // Function to animate the scrolling
  function animateScrolling() {
    if (isPaused) return;

    // Get the first list item
    const firstItem = listItems[0];

    // Clone the first item and append it to the end of the list
    const clonedItem = firstItem.cloneNode(true);
    list.appendChild(clonedItem);

    // Animate the scrolling
    list.style.transform = 'translateY(-' + firstItem.offsetHeight + 'px)';
    list.style.transition = 'transform ' + animationDuration + 'ms';

    // Remove the first item after the animation is complete
    setTimeout(() => {
      list.removeChild(firstItem);
      list.style.transform = '';
      list.style.transition = '';
      animateScrolling();
    }, animationDuration + animationDelay);
  }

  // Event listener to pause the animation on hover
  container.addEventListener('mouseover', () => {
    isPaused = true;
  });

  // Event listener to resume the animation on mouseout
  container.addEventListener('mouseout', () => {
    isPaused = false;
    animateScrolling();
  });

  // Start the animation
  animateScrolling();
});

// -------------------------------------

  // Save scroll position before the page unloads
  window.addEventListener('beforeunload', () => {
    localStorage.setItem('scrollPosition', window.scrollY);
  });


  // window.addEventListener('load', () => {
  //   const scrollPosition = localStorage.getItem('scrollPosition');
  //   if (scrollPosition) {
  //     window.scrollTo(0, parseInt(scrollPosition, 10));
  //   }
  // });

  document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('scroll', function() {
        var titleElement = document.querySelector('.wyt');
        var titleElementsub = document.querySelector('.darki');

        if (titleElement && titleElementsub) {
            var position = titleElement.getBoundingClientRect().top;

            if (position <= 250) {
                titleElement.classList.add('text-white');
                titleElementsub.classList.add('text-white');
            } else {
                titleElement.classList.remove('text-white');
                titleElementsub.classList.remove('text-white');
            }
        }
    });
});


        document.addEventListener("scroll", function() {
          var container = document.querySelector(".headex");
          if (window.scrollY > 90) {
            container.classList.add("stick");
          } else {
            container.classList.remove("stick");
          }
        });


        document.addEventListener('DOMContentLoaded', function() {
          document.addEventListener('scroll', function() {
              var overviewSection = document.querySelector('.overview');
      
              if (overviewSection) {  // Check if the element exists
                  var sectionPosition = overviewSection.getBoundingClientRect().top;
      
                  if (sectionPosition <= 50) {
                      overviewSection.style.backgroundImage = "radial-gradient(circle at 10% 20%, rgb(7, 121, 222) 0%, rgb(20, 72, 140) 90%)";
                  } else {
                      overviewSection.style.backgroundImage = 'none';
                  }
              }
          });
      });

      
      document.addEventListener('DOMContentLoaded', function() {
        const filterLinks = document.querySelectorAll('.pbmit-sortable-link');
        const products = document.querySelectorAll('.pbmit-product-style-1');
    
        filterLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();  // Prevent default anchor behavior
    
                const filter = this.getAttribute('data-sortby'); // Get the category to filter by
                
                // Remove the 'pbmit-selected' class from all links
                filterLinks.forEach(link => link.classList.remove('pbmit-selected'));
                
                // Add the 'pbmit-selected' class to the clicked link
                this.classList.add('pbmit-selected');
                
                products.forEach(product => {
                    // Get the product's category from the 'data-category' attribute
                    const category = product.getAttribute('data-category');
                    
                    // Show all products if the filter is '*', else show only matching products
                    if (filter === '*' || category === filter) {
                        product.style.display = 'block';  // Show the product
                    } else {
                        product.style.display = 'none';  // Hide the product
                    }
                });
            });
        });
    });
    
