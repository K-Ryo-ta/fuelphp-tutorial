<html>

<body>
  <h1>配列情報の表示</h1>
  <ul>
    <?php foreach ($fruits as $fruit): ?>
      <li><?php echo $fruit ?></li>
    <?php endforeach; ?>
    <table>
      <tr>
        <th>名前</th>
        <th>年齢</th>
      </tr>
      <?php foreach ($members as $member): ?>
        <tr>
          <td><?php echo $member['name'] ?></td>
          <td><?php echo $member['age'] ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </ul>
</body>

</html>
