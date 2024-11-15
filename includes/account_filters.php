<div class="d-flex mb-3">
    <select id="role" class="form-control w-auto mr-2" name="roleSelection" onchange="filterAccounts()">
        <option value="all">--All Users--</option>
        <option value="instructor">Instructor</option>
        <option value="student">Student</option>
    </select>

    <div class="d-flex align-items-center ml-auto">
        <input type="search" class="form-control w-auto mr-2" style="min-width: 200px;" id="searchAccount" placeholder="Enter name here" onkeyup="filterAccounts()">
        <button class="btn btn-danger" data-toggle="modal" data-target="#addAccountModal">+ Add</button>
    </div>
</div>
