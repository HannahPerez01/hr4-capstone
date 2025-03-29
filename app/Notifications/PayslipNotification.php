<?php
namespace App\Notifications;

use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PayslipNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public $payroll)
    {
        $this->payroll = $payroll;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = env('SYSTEM2_URL');

        return (new MailMessage)
            ->subject('Your Payslip is Ready')
            ->line('Your latest payslip has been generated. Click the button below to view it.')
            ->action('View Payslip', "{$url}/ess-portal/payrolls/{$this->payroll->id}/view-payslip")
            ->line('Thank you for using our payroll system!');
    }

    public function toDatabase(object $notifiable): array
    {
        $url = env('SYSTEM2_URL');

        return FilamentNotification::make()
            ->title('Payslip is now ready')
            ->info()
            ->actions([
                Action::make('markAsRead')
                    ->button()
                    ->markAsRead(),

                Action::make('view')
                    ->link()
                    ->url("{$url}/ess-portal/payrolls/{$this->payroll->id}/view-payslip"),
            ])
            ->send()
            ->getDatabaseMessage();
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
