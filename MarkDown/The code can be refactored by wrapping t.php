The code can be refactored by wrapping the entire block of code in a loop that iterates 3 times, and dynamically outputs
the parameter of the tarjetas function as the loop variable. Also, each pagination div should have a unique ID. The
refactored code is shown below:

```
<div>
    <?php for ($i = 1; $i <= 3; $i++) { ?>
        <div class="container">
            <?php tarjetas($i); ?>
            <div class="pagination">
                <button id="prev-btn-<?php echo $i; ?>"> 🔙 </button>
                <button id="next-btn-<?php echo $i; ?>"> 🔜 </button>
            </div>
        </div>
    <?php } ?>
</div>
```