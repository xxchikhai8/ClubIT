
<?php include_once('ConnectDB.php'); ?>

<body>

    <div id="manage-container">
        <p class="head-label">Manage Event</p>
        <div class="detail-mn">

            <!-- modal update -->
            <div class="modal js-modal ">
                <form id="form-update" class="modal-container js-modal-container" method="POST" action="ManageEventPro.php">
                    <div class="modal-header">
                        <div class="modal-label">
                            <p>Update Event Infomation </p>
                        </div>
                        <div class="model-close js-modal-close">
                            <i class=" icon-close">X</i>
                        </div>
                    </div>
                    <div class="modal-body">
                        <?php
                        if (isset($_GET['func']) && $_GET['func'] = 'update') {
                            $id = $_GET['id'];
                            $res = mysqli_query($conn, "SELECT * FROM `event` WHERE id='$id'");
                        }

                        $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
                        ?>
                        <div class="modal-input">
                            <input id="id" name="id" type="hidden" value="<?php echo $row['id'] ?>" class="input-info" placeholder="Event Name">
                            <input id="title" name="title" type="text" value="<?php echo $row['title'] ?>" class="input-info" placeholder="Event Name">
                            <p class="error-ev"></p>
                        </div>
                        <div class="modal-input">
                            <input id="date" name="date" type="date" value="<?php echo $row['date'] ?>" class="input-info" placeholder="Date">
                            <p class="error-ev"></p>
                        </div>
                        <div class="modal-input">
                            <input type="time" id="time" name="time" value="<?php echo $row['time'] ?>" class="input-info" placeholder="Time">
                            <p class="error-ev"></p>
                        </div>
                        <div class="modal-input">
                            <input id="location" name="location" type="text" value="<?php echo $row['location'] ?>" class="input-info" placeholder="Location">
                            <p class="error-ev"></p>
                        </div>
                        <div class="modal-input">
                            <input id="description" name="description" type="text" value="<?php echo $row['description'] ?>" class="input-info" placeholder="Description">
                            <p class="error-ev"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="button">
                            <button name="btn_update" id="btn_update" type="submit" class="modal-button">Update Event</button>
                            <button name="btn_delete" id="btn_delete" style="background-color:rgb(197, 102, 68); color:#000;" type="submit" class="modal-button">Delete Event</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- finish modal -->

            <!-- /model adduser -->
            <div class="modaluser js-modal-user">
                <form id="form-add" class="modal-container js-modal-container-user" method="POST" action="ManageEventPro.php?func=add">
                    <div class="modal-header">
                        <div class="modal-label">
                            <p> Add New Event </p>
                        </div>
                        <div class="model-close js-modal-close-user">
                            <i class=" icon-close">X</i>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="modal-input">
                            <input type="text" class="input-info" name="title" id="title" placeholder="Event Name">
                            <p class="error-ev"></p>
                        </div>
                        <div class="modal-input">
                            <input type="date" class="input-info" name="date" id="date" placeholder="Date">
                            <p class="error-ev"></p>
                        </div>
                        <div class="modal-input">
                            <input type="time" class="input-info" name="time" id="time" placeholder="Time">
                            <p class="error-ev"></p>
                        </div>
                        <div class="modal-input">
                            <input type="text" class="input-info" id="location" name="location" placeholder="Location">
                            <p class="error-ev"></p>
                        </div>
                        <div class="modal-input">
                            <input type="text" class="input-info" name="description" id="description" placeholder="Description">
                            <p class="error-ev"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="button">
                            <button type="submit" class="modal-button" name="btn_add" id="btn_add">Add New</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- finish modal user -->


            <div class="detail-right">
                <div class="btn-add">
                    <button class="add-user js-add-user"> Add New Event</button>
                </div>
                <div class="table-1">
                    <table class="table">
                        <thead class="table-head">

                            <tr class="tr-head">
                                <th class="th-head">ID | Title</th>
                                <th class="th-head">Date</th>
                                <th class="th-head">Time</th>
                                <th class="th-head">Location</th>
                                <th class="th-head">Description</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM `event`");
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            ?>
                                <tr class="tr-body">

                                    <td class="td-body">
                                        <a href="?page=manageevent_update&&func=update&&id=<?php echo $row['id']; ?>" class="update-name js-update-name"> <?php echo $row['id']; ?> | <?php echo $row['title']; ?> </a>
                                    </td>
                                    <td class="td-body"><?php echo $row['date']; ?></td>
                                    <td class="td-body"><?php echo $row['time']; ?></td>
                                    <td class="td-body"><?php echo $row['location']; ?></td>
                                    <td class="td-body"><?php echo $row['description']; ?></td>
                                </tr>
                            <?php }; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>
        const editInfors = document.querySelectorAll('.js-update-name') //sellect the class use to use js
        const modalclose = document.querySelector('.js-modal-close')
        const modal = document.querySelector('.js-modal')
        const modalcontainer = document.querySelector('.js-modal-container')
        modal.classList.add('open')


        function showModal() {
            modal.classList.add('open')
        }

        for (const editInfor of editInfors) {
            editInfor.addEventListener('click', showModal)
        }

        function hideModal() {
            modal.classList.remove('open')
        }
        modalclose.addEventListener('click', hideModal)

        modal.addEventListener('click', hideModal)

        modalcontainer.addEventListener('click', function(event) {
            event.stopPropagation() //stop nổi bọt
        })


        const addUsers = document.querySelectorAll('.js-add-user') //sellect the class use to use js
        const modalcloseUser = document.querySelector('.js-modal-close-user')
        const modalUser = document.querySelector('.js-modal-user')
        const modalcontainerUser = document.querySelector('.js-modal-container-user')

        function showModalAdd() {
            modalUser.classList.add('open')
        }

        for (const addUser of addUsers) {
            addUser.addEventListener('click', showModalAdd)
        }

        function hideModalAdd() {
            modalUser.classList.remove('open')
        }
        modalcloseUser.addEventListener('click', hideModalAdd)

        modalUser.addEventListener('click', hideModalAdd)

        modalcontainerUser.addEventListener('click', function(event) {
            event.stopPropagation() //stop nổi bọt
        })
    </script>
    <!-- <script src="./js/validator.js"></script>
    <script>
        Validator({
            form: '#form-add',
            formGroupSelector: '.form-group',
            errorSelector: '.error-ev',
            rules: [
                Validator.isRequired('#title', 'this feild can not empty'),
                Validator.isRequired('#date', 'this feild can not empty'),
                Validator.isRequired('#time', 'this feild can not empty'),
                Validator.isRequired('#location', 'this feild can not empty'),
                Validator.isRequired('#description', 'this feild can not empty'),
            ],
        });
        Validator({
            form: '#form-update',
            formGroupSelector: '.form-group',
            errorSelector: '.error-ev',
            rules: [
                Validator.isRequired('#title', 'this feild can not empty'),
                Validator.isRequired('#date', 'this feild can not empty'),
                Validator.isRequired('#time', 'this feild can not empty'),
                Validator.isRequired('#location', 'this feild can not empty'),
                Validator.isRequired('#description', 'this feild can not empty'),
            ],
        });
    </script> -->
</body>
