<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use FPDF;

class GenerateSampleCertificate extends Command
{
    protected $signature = 'certificate:generate {user_name?} {workshop_title?} {workshop_date?} {certificate_number?} {instructor?}';
    protected $description = 'Generate a sample certificate PDF';

    public function handle()
    {
        $userName = $this->argument('user_name') ?? 'Vishal';
        $workshopTitle = $this->argument('workshop_title') ?? 'Android App Development';
        $workshopDate = $this->argument('workshop_date') ?? 'May 25, 2025';
        $certificateNumber = $this->argument('certificate_number') ?? 'CERT-2025-00001';
        $instructor = $this->argument('instructor') ?? 'Sneha Kapoor';

        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->SetAutoPageBreak(false);
        $pdf->AddPage();
        
        // Set background color
        $pdf->SetFillColor(27, 34, 49);
        $pdf->Rect(0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight(), 'F');
        
        // Add certificate number at top right
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell($pdf->GetPageWidth() - 40, 20, $certificateNumber, 0, 1, 'R');
        
        // Add certificate title
        $pdf->SetFont('Arial', 'B', 40);
        $pdf->SetTextColor(255, 184, 0);
        $pdf->Cell(0, 30, 'CERTIFICATE OF COMPLETION', 0, 1, 'C');
        
        // Add description
        $pdf->SetFont('Arial', '', 16);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(0, 20, 'This is to certify that', 0, 1, 'C');
        
        // Add participant name
        $pdf->SetFont('Arial', 'B', 24);
        $pdf->SetTextColor(255, 184, 0);
        $pdf->Cell(0, 20, $userName, 0, 1, 'C');
        
        // Add more description
        $pdf->SetFont('Arial', '', 16);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(0, 20, 'has successfully completed the workshop', 0, 1, 'C');
        
        // Add workshop name
        $pdf->SetFont('Arial', 'B', 24);
        $pdf->SetTextColor(255, 184, 0);
        $pdf->Cell(0, 20, $workshopTitle, 0, 1, 'C');
        
        // Add date
        $pdf->SetFont('Arial', '', 14);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(0, 30, 'Date: ' . $workshopDate, 0, 1, 'C');
        
        // Add signature placeholder and instructor name
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 20, '_______________________', 0, 1, 'C');
        $pdf->Cell(0, 10, $instructor, 0, 1, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Workshop Instructor', 0, 1, 'C');
        
        // Save the PDF
        $storagePath = storage_path('app/public/sample_certificate.pdf');
        $pdf->Output('F', $storagePath);
        
        $this->info('Sample certificate generated successfully at: ' . $storagePath);
    }
}
