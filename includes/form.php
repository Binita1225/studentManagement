<?php if(!empty($error)) : ?>
    <!-- error empty xaina vana error throw garxa -->
<ul>
<?php foreach($error as $error): ?>
<li><?= $error ?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
<form action="" method="post">
    <h3>Student Details</h3>
    <div>
        <label for="name">Name: </label>
        <input type="text" name="name" id="name" placeholder="Enter name" value="<?=htmlspecialchars($name); ?>">
    </div>
    <div>
        <label for="contact">Contact: </label>
        <input type="number" name="contact" id="contact" placeholder="Contact" value="<?=htmlspecialchars($contact); ?>">
    </div>
    <div>
        <label for="class">Class: </label>
        <input type="number" name="class" id="class" placeholder="class" value="<?=htmlspecialchars($class); ?>">
    </div>
    <h3>Academic</h3>
    <p>Input Marks</p>
    <div>
        <label for="maths">Maths: </label>
        <input type="number" name="maths" id="maths" value="<?=htmlspecialchars($maths); ?>">
    </div>
    <div>
        <label for="science">Science: </label>
        <input type="number" name="science" id="science" value="<?=htmlspecialchars($science); ?>">
    </div>
    <div>
        <label for="social">Social: </label>
        <input type="number" name="social" id="social" value="<?=htmlspecialchars($social); ?>">
    </div>
    <div>
        <label for="english">English: </label>
        <input type="number" name="english" id="english" value="<?=htmlspecialchars($english); ?>">
    </div>
    <div>
        <label for="computer">Computer: </label>
        <input type="number" name="computer" id="computer" value="<?=htmlspecialchars($computer); ?>">
    </div>
    <button>Save</button>
</form>