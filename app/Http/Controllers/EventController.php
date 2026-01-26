<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use App\Models\Registration;
use App\Http\Requests\StoreEventRequest;

class EventController extends Controller
{
 
    public function index()
    {
        // Affichage des événements pour l'admin
        if (request()->routeIs('admin.events.index')) {
            $events = Event::orderBy('aa_start_date', 'desc')
                ->paginate(5);
            return view('events.admin_index', compact('events'));
        }

        // Affichage des événements pour les utilisateurs (page publique)
        $query = Event::query();

        // Search selon title ou description
        if ($search = request('search')) {
            $query->where(function($q) use ($search) {
                $q->where('aa_title', 'like', "%{$search}%")
                  ->orWhere('aa_description', 'like', "%{$search}%");               
            });
        }

        // Date Filter
        if ($dateFilter = request('date_filter')) {
            if ($dateFilter === 'Weekdays') {
                //samedi->5 et dimanche->6
                $query->whereRaw('WEEKDAY(aa_start_date) < 5');
            } elseif ($dateFilter === 'Weekends') {
                $query->whereRaw('WEEKDAY(aa_start_date) >= 5');
            }
        }
        // Category Filter
        if ($catId = request('category_id')) {
            if ($catId !== 'Any category') {
                $query->where('aa_category_id', $catId);
            }
        }

        $events = $query->orderBy('aa_id', 'desc')->cursorPaginate(6)->withQueryString();

        if (request()->ajax()) {
            $html = '';
            foreach ($events as $event) {
                $html .= view('events.partials.event_card', compact('event'))->render();
            }

            return response()->json([
                'html' => $html,
                'next_page_url' => $events->nextPageUrl(),
            ]);
        }

        return view('events.index', compact('events'));
    }

 
    public function home()
    {

        // Affichage des événements pour les utilisateurs (page publique)
        $query = Event::query();

        // Search selon title ou description
        if ($search = request('search')) {
            $query->where(function($q) use ($search) {
                $q->where('aa_title', 'like', "%{$search}%")
                  ->orWhere('aa_description', 'like', "%{$search}%");               
            });
        }

        // Date Filter
        if ($dateFilter = request('date_filter')) {
            if ($dateFilter === 'Weekdays') {
                //samedi->5 et dimanche->6
                $query->whereRaw('WEEKDAY(aa_start_date) < 5');
            } elseif ($dateFilter === 'Weekends') {
                $query->whereRaw('WEEKDAY(aa_start_date) >= 5');
            }
        }
        // Category Filter
        if ($catId = request('category_id')) {
            if ($catId !== 'Any category') {
                $query->where('aa_category_id', $catId);
            }
        }

        $events = $query->orderBy('aa_id', 'desc')->cursorPaginate(6)->withQueryString(); /////ppur avvoir events?search=laravel&category_id=2 au lieu de /events?cursor=eyJpZCI6...


        if (request()->ajax()) {
            $html = '';
            foreach ($events as $event) {
                $html .= view('events.partials.event_card', compact('event'))->render();//render() transforme la vue Blade en HTML pur car js ne comprnd pas blade
            }

            return response()->json([
                'html' => $html,
                'next_page_url' => $events->nextPageUrl(),
            ]);
        }

        return view('events.index', compact('events'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('events.create', compact('categories'));
    }

    public function store(StoreEventRequest $request)
    {
        $validated = $request->validated();

        // Conversion en booléen car l'input renvoie "1" ou "0"
        $validated['aa_is_free'] = (bool) $validated['aa_is_free'];
        $validated['aa_created_by'] = auth()->id();

        // Si c'est gratuit, on force à 0. Si c'est payant mais vide, on met 0 par défaut pour éviter le crash SQL
        if ($validated['aa_is_free']) {
            $validated['aa_price'] = 0;
        } elseif (!isset($validated['aa_price']) || $validated['aa_price'] === null) {
            $validated['aa_price'] = 0;
        }

        if ($request->hasFile('aa_image')) {
            $file = $request->file('aa_image');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('events', $filename, 'public');
            $validated['aa_image'] = $path;
        }

        Event::create($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }
 
    public function show(string $id)
    {
         $event = Event::findOrFail($id);
        
        // Fetch related events: same category, not current event, random 3
        $relatedEvents = Event::where('aa_category_id', $event->aa_category_id)
            ->where('aa_id', '!=', $id)
            ->inRandomOrder()
            ->take(6)
            ->get();
            
        return view('events.show', compact('event', 'relatedEvents'));
    }

    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        $categories = Category::all();
        return view('events.edit', compact('event', 'categories'));
    }

    public function update(StoreEventRequest $request, string $id)
    {
       $validated = $request->validated();

        $event = Event::findOrFail($id);
        
        // Conversion en booléen car l'input renvoie "1" ou "0"
        $validated['aa_is_free'] = (bool) $validated['aa_is_free'];

        // Fix: If free, force price to 0. Si c'est payant mais vide, on met 0 par défaut pour éviter le crash SQL
        if ($validated['aa_is_free']) {
            $validated['aa_price'] = 0;
        } elseif (!isset($validated['aa_price']) || $validated['aa_price'] === null) {
            $validated['aa_price'] = 0;
        }

        if ($request->hasFile('aa_image')) {
            $file = $request->file('aa_image');
            $filename = $file->getClientOriginalName();  
            // Store with original name in 'public/events' folder
            $path = $file->storeAs('events', $filename, 'public');
            $validated['aa_image'] = $path;
        } else {
            // no null if no new image uploaded
            unset($validated['aa_image']);
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }

    public function register(string $eventId)
    {
        $event = Event::findOrFail($eventId);
        $user = auth()->user();

        // Un même utilisateur ne peut s'inscrire qu'une seule fois
        if ($event->registrations()->where('aa_user_id', $user->aa_id)->exists()) {
            return back()->with('error', 'You are already registered for this event.');
        }

        // Vérifier si des places sont disponibles
        if ($event->aa_capacity <= 0) {
            return back()->with('error', 'This event is full.');
        }

        Registration::create([
            'aa_user_id' => $user->aa_id,
            'aa_event_id' => $event->aa_id,
        ]);

        // Décrémenter les places disponibles
        $event->decrement('aa_capacity');

        return back()->with('success', 'Successfully registered for the event!');
    }

    public function unregister(string $eventId)
    {
        $registration = Registration::where('aa_user_id', auth()->id())
            ->where('aa_event_id', $eventId)
            ->firstOrFail();
            
        $event = $registration->event;

        // Annulation : Possible uniquement au moins une semaine avant l'événement
        if (now()->diffInDays($event->aa_start_date, false) < 7) {
            return back()->with('error', 'Cancellations are only allowed at least one week before the event.');
        }

        $registration->delete();

        // Incrémenter les places disponibles
        $event->increment('aa_capacity');

        return back()->with('success', 'Successfully unregistered. Your spot has been freed.');
    }
}
