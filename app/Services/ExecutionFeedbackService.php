<?php

namespace App\Services;

class ExecutionFeedbackService
{
    public static function generate(array $data): string
    {
        $feedback = [];
        $angleFeedbackGiven = false; // 👈 NIEUW

        /* ⚙️ CONFIG */
        $tolerance = 5; // graden tolerantie
        $match = round($data['match_percentage'], 1);
        $ref = round($data['reference_peak'], 1);
        $dir = $data['direction'];

        /* 1️⃣ MATCH FEEDBACK (ALTIJD) */
        if ($match < 70) {
            $feedback[] =
                "Your match percentage was {$match}%. "
                . "Try to follow the reference video better next time.";
        } elseif ($match < 85) {
            $feedback[] =
                "Your match percentage was {$match}%. "
                . "You are getting close to the reference movement.";
        } else {
            $feedback[] =
                "Your match percentage was {$match}%. "
                . "Great job following the reference movement.";
        }

        /* 2️⃣ ANGLE-BASED FEEDBACK (MET TOLERANTIE) */

        // ➜ EXTENSION → kijk naar MAX angle
        if ($dir === 'extension' && isset($data['max_angle'])) {
            $measured = round($data['max_angle'], 1);

            if ($measured < ($ref - $tolerance)) {
                $feedback[] =
                    "The maximum angle you made was {$measured} degrees. "
                    . "The reference showed an angle of {$ref} degrees. "
                    . "Try to extend more during the next performance.";
                $angleFeedbackGiven = true;
            }
            elseif ($measured > ($ref + $tolerance)) {
                $feedback[] =
                    "The maximum angle you made was {$measured} degrees. "
                    . "The reference showed an angle of {$ref} degrees. "
                    . "Try to extend less during the next performance.";
                $angleFeedbackGiven = true;
            }
        }

        // ➜ FLEXION → kijk naar MIN angle
        if ($dir === 'flexion' && isset($data['min_angle'])) {
            $measured = round($data['min_angle'], 1);

            if ($measured > ($ref + $tolerance)) {
                $feedback[] =
                    "The minimum angle you made was {$measured} degrees. "
                    . "The reference showed an angle of {$ref} degrees. "
                    . "Try to flex more during the next performance.";
                $angleFeedbackGiven = true;
            }
            elseif ($measured < ($ref - $tolerance)) {
                $feedback[] =
                    "The minimum angle you made was {$measured} degrees. "
                    . "The reference showed an angle of {$ref} degrees. "
                    . "Try to flex less during the next performance.";
                $angleFeedbackGiven = true;
            }
        }

        /* 3️⃣ FALLBACK ALS HOEKEN GOED ZIJN */
        if (!$angleFeedbackGiven) {
            $feedback[] =
                "Great performance. The angle you made closely matched the reference.";
        }

        return implode(" ", $feedback);
    }
}
