public class BankAccount {
    private double balance;

    public double getBalance() {
        return balance;
    }
}

public class Bank {
    public void withdraw(BankAccount account, double amount) {
        account.balance -= amount;
    }
}
